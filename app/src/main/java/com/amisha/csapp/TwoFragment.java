package com.amisha.csapp;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.amisha.csapp.activity.RegisterActivity;
import com.amisha.csapp.app.AppConfig;
import com.amisha.csapp.app.AppController;
import com.amisha.csapp.helper.SQLiteHandler;
import com.amisha.csapp.helper.SessionManager;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Shubhi on 4/11/2016.
 */
public class TwoFragment extends Fragment implements OnClickListener {
    public TwoFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_two, container, false);
    }

    @Override
    public void onViewCreated(View view,Bundle savedInstanceState) {
        //super.onViewCreated(view, savedInstanceState);
        Button btn=(Button) getActivity().findViewById(R.id.btnLinkToRegisterScreen);
        btn.setOnClickListener((OnClickListener)this);

    }

    @Override
    public void onClick(View view) {
        Intent i = new Intent( getActivity(),NextActivity.class );
        startActivity(i);
    }
}
