package com.example.halamanuser;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    private Button hadir, cetak;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        hadir=findViewById(R.id.hadir);
        cetak=findViewById(R.id.cetak);

        hadir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //cara1
                startActivity(new Intent(getApplicationContext(), Absen.class));
            }
        });
        cetak.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getApplicationContext(), Cetakdata.class));
            }
        });


    }

}