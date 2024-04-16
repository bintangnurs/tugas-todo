package com.example.kalkulator;


import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import java.net.MalformedURLException;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.os.Message;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private EditText etX;
    private EditText etY;
    private TextView tvHasil;
    private Button btSubmit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        this.etX = this.findViewById(R.id.etX);
        this.etY = this.findViewById(R.id.etY);
        this.tvHasil = this.findViewById(R.id.tvHasil);
        this.btSubmit = this.findViewById(R.id.btSubmit);
        this.btSubmit.setOnClickListener(this);
    }


    @Override
    public void onClick(View v) {
        String x = this.etX.getText().toString();
        String y = this.etY.getText().toString();
        Handler h = new Handler(Looper.getMainLooper()) {
            @Override
            public void handleMessage(@NonNull Message msg) {
                super.handleMessage(msg);
                Bundle bundle = msg.getData();
                String z = bundle.getString("z");
                int random = bundle.getInt("random");
                tvHasil.setText(z + "/" + random);
            }
        };
        Thread t = new SumThread(x,y,h);
        t.start();
    }

}