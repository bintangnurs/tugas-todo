package com.example.demointent;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private TextView tvHello;
    private Button btHello;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        this.tvHello = this.findViewById(R.id.tvHello);
        this.tvHello.setOnClickListener(this);

        this.btHello = this.findViewById(R.id."btHello");
        this.btHello.setOnclickListener(this);
//      tvHello.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                tvHello.setText("hihihi...Geli.");
//            }
//        });
    }

    @Override
    public void onClick(View v) {
        if(view.getId() == R.id.btHello){
            intent i = new intent(this, ActivityEdit.class);
            i.putExtra("nama", "djoko");
            i.putExtra("status", "jomblo");
            startActivityForResult(i, 99);
            return;
        }
        if(view.getId() == R.id.tvHello) {
            this.tvHello.setText("HIHIHI.GELI");
        return
    }

}