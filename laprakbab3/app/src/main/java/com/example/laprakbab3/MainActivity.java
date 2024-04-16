package com.example.laprakbab3;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

        private EditText etEmail;
        private EditText etPassword;

        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_main);

            etEmail = findViewById(R.id.etEmail);
            etPassword = findViewById(R.id.etPassword);

            Button btnLogin = findViewById(R.id.btnLogin);
            btnLogin.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    // Lakukan pengecekan email dan password
                    String email = etEmail.getText().toString().trim();
                    String password = etPassword.getText().toString().trim();

                    if (email.isEmpty() || password.isEmpty()){
                        Toast.makeText(MainActivity.this,
                                "Email dan Password tidak boleh kosong",
                                Toast.LENGTH_SHORT).show();
                    } else {
                        Toast.makeText(MainActivity.this,
                                "Berhasil Log In", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(MainActivity.this, head.class);
                       intent.putExtra("email_key", email);
                        startActivity(intent);
                    }
                }
            });
        }
    }

