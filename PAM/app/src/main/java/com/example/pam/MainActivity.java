package com.example.pam;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;

public class MainActivity extends AppCompatActivity {

    private boolean isLayout1 = true;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        if (isLayout1) {
            setContentView(R.layout.layout_hello_world);
        } else {
            setContentView(R.layout.layout_nama_nim);
        }
        isLayout1 = !isLayout1;
    }
}