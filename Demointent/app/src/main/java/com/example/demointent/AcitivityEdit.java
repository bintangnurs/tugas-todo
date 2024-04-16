package com.example.demointent;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.EditText;

public class AcitivityEdit extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_acitivity_edit);
        EditText etHello = this.findViewById(R.id.etDemo);
        etHello.setOnKeyListener(this);
    }

    @Override
    protected void onResume() {
        super.onResume();
        Intent i = this.getIntent();
        String nama = i.getStringExtra("nama");
        String status = i.getStringExtra("status");
        EditText etHello = this.findViewById(R.id.etDemo);
        etHello.setText(nama + " " + status);

    }
}