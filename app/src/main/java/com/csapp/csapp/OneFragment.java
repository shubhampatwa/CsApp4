package com.csapp.csapp;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.csapp.csapp.app.AppConfig;
import com.csapp.csapp.app.AppController;
import com.csapp.csapp.helper.SQLiteHandler;
import com.csapp.csapp.helper.SessionManager;
import com.csapp.csapp.student.StudentMain;
import com.csapp.csapp.student.StudentRegister;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Shubhi on 4/11/2016.
 */
public class OneFragment extends Fragment {
    private static final String TAG = OneFragment.class.getSimpleName();
    //    private Button btnLogin;
//    private Button btnLinkToRegister;
    private EditText inputEnroll;
    private EditText inputPassword;
    private ProgressDialog pDialog;
    private SessionManager session;
    private SQLiteHandler db;



    public OneFragment() {
        // Required empty public constructor
    }

    /**
     * function to verify login details in mysql db
     * */
    private void checkLogin (final String enroll, final String password) {
        // Tag used to cancel the request
        String tag_string_req = "req_login";

        pDialog.setMessage("Logging in ...");
        showDialog();

        StringRequest strReq = new StringRequest(Request.Method.POST,
                AppConfig.URL_STUDENT_LOGIN, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(TAG, "Login Response: " + response.toString());
                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");

                    // Check for error node in json
                    if (!error) {
                        // user successfully logged in
                        // Create login session
                        session.setLogin(true);

                        // Now store the user in SQLite
                        String uid = jObj.getString("uid");

                        JSONObject user = jObj.getJSONObject("user");
                        String name = user.getString("name");
                        String enroll = user.getString("enroll");
                        String created_at = user
                                .getString("created_at");
                        //String type="teacher";

                        // Inserting row in users table
                        db.addStudent(name, enroll, uid, created_at);
                        //Toast.makeText(getActivity(),"adduser",Toast.LENGTH_LONG).show();

                        // Launch main activity
                        Intent intent = new Intent(getActivity(),
                                StudentMain.class);
                        startActivity(intent);
                        getActivity().finish();
                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getActivity(),
                                errorMsg, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                    Toast.makeText(getActivity(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(TAG, "Login Error: " + error.getMessage());
                Toast.makeText(getActivity(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<String, String>();
                params.put("enroll", enroll);
                params.put("password", password);

                return params;
            }

        };

        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }





    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_one, container, false);
    }

    @Override
    public void onViewCreated(View view,Bundle savedInstanceState) {
        //super.onViewCreated(view, savedInstanceState);
//        Button btn=(Button) getActivity().findViewById(R.id.btnLinkToRegisterScreen);
//        btn.setOnClickListener(new View.OnClickListener(){
//            @Override
//            public void onClick(View view) {
//                Intent i=new Intent(getActivity(),TeacherRegister.class);
//                startActivity(i);
//               // getActivity().finish();
//            }
//        });
        inputEnroll = (EditText) getActivity().findViewById(R.id.enroll);
        inputPassword = (EditText) getActivity().findViewById(R.id.password1);
        Button btnLogin = (Button) getActivity().findViewById(R.id.btnstudentLogin);
        Button btnLinkToRegister = (Button) getActivity().findViewById(R.id.btnstudentLinkToRegisterScreen);
//        String a=inputenroll.toString();
//        Toast.makeText(getActivity(),a,Toast.LENGTH_LONG).show();

        // Progress dialog
        pDialog = new ProgressDialog(getActivity());
        pDialog.setCancelable(false);

        // SQLite database handler
        db = new SQLiteHandler(getActivity());

        // Session manager
        session = new SessionManager(getActivity());

        // Check if user is already logged in or not
        if (session.isLoggedIn()) {
            // User is already logged in. Take him to main activity
            Intent intent = new Intent(getActivity(), StudentMain.class);
            startActivity(intent);
            getActivity().finish();
        }
        //check login
        btnLogin.setOnClickListener(new View.OnClickListener() {

            public void onClick(View view) {
                String enroll = inputEnroll.getText().toString().trim();
                String password = inputPassword.getText().toString().trim();
           //     Toast.makeText(getActivity(),enroll+password,Toast.LENGTH_SHORT).show();
                // Check for empty data in the form
                if (!enroll.isEmpty() && !password.isEmpty()) {
                    // login user
                    checkLogin(enroll, password);
                } else {
                    // Prompt user to enter credentials
                    Toast.makeText(getActivity(),
                            "Please enter the credentials!", Toast.LENGTH_LONG)
                            .show();
                }
            }

        });
//                 Link to Register Screen
        btnLinkToRegister.setOnClickListener(new View.OnClickListener() {

            public void onClick(View view) {
                Intent i = new Intent(getActivity(),
                        StudentRegister.class);
                startActivity(i);
                //getActivity().finish();
            }
        });
    }

}
