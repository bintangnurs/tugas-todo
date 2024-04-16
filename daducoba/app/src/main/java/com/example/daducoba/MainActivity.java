package com.example.dadu;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.os.Message;
import android.view.View;
import android.widget.TextView;

import com.example.daducoba.DaduThread;
import com.example.daducoba.R;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private Handler uiHandler;
    private DaduThread daduThread;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        findViewById(R.id.button)
                .setOnClickListener(this);
        this.uiHandler = new Handler(Looper.getMainLooper()) {
            @Override
            public void handleMessage(@NonNull Message msg) {
                super.handleMessage(msg);
                Bundle bundle = msg.getData();
                int angka = bundle.getInt("angka");
                TextView tvAngka = findViewById(R.id.tvAngka);
                tvAngka.setText(String.valueOf(angka));
            }
        };
    }

    @Override
    public void onClick(View view) {
        if(this.daduThread == null) {
            this.daduThread = new DaduThread(this.uiHandler);
            this.daduThread.start();
        } else {
            this.daduThread.interrupt();
            this.daduThread = null;
        }
    }
}