package com.example.laprak4head;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;

public class MainActivity extends AppCompatActivity {
    private CheckBox cbRambut;
    private CheckBox cbKumis;
    private CheckBox cbJanggut;
    private CheckBox cbAlis;

    private ImageView ivRambut;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        CheckBox cbRambut = findViewById(R.id.cbRambut);
        ImageView ivRambut = findViewById(R.id.ivRambut);
        CheckBox cbKumis = findViewById(R.id.cbKumis);
        ImageView ivKumis = findViewById(R.id.ivKumis);
        CheckBox cbJanggut = findViewById(R.id.cbJanggut);
        ImageView ivJanggut = findViewById(R.id.ivBeard);
        CheckBox cbAlis = findViewById(R.id.cbAlis);
        ImageView ivAlis = findViewById(R.id.ivEyebrow);

        cbRambut.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked){
                    ivRambut.setVisibility(View.VISIBLE);
                }else {
                    ivRambut.setVisibility(View.GONE);
                }
            }
        });

        cbAlis.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked){
                    ivAlis.setVisibility(View.VISIBLE);
                }else {
                    ivAlis.setVisibility(View.GONE);
                }
            }
        });

        cbJanggut.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked){
                    ivJanggut.setVisibility(View.VISIBLE);
                }else {
                    ivJanggut.setVisibility(View.GONE);
                }
            }
        });

        cbKumis.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked){
                    ivKumis.setVisibility(View.VISIBLE);
                }else {
                    ivKumis.setVisibility(View.GONE);
                }
            }
        });

    }


}