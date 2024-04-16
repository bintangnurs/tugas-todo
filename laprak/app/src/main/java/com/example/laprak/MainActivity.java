package com.example.laprak;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.widget.EditText;
import android.widget.TextView;
import android.text.TextWatcher;
import android.text.Editable;

import android.os.Bundle;

public class MainActivity extends AppCompatActivity {

    private EditText editTextFirstName;
    private EditText editTextLastName;
    private TextView textViewFullName;

    private boolean isLayout1 = true;

    private static final String KEY_FIRST_NAME = "first_name";
    private static final String KEY_LAST_NAME = "last_name";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // Menampilkan layout pertama atau kedua bergantian
        if (isLayout1) {
            setContentView(R.layout.activity_main);
        } else {
            setContentView(R.layout.layout2);
        }

        // Setelah menampilkan layout, ubah status untuk tampilan berikutnya
        isLayout1 = !isLayout1;

        // Jika instance state tidak null, restore nilai EditText
        if (savedInstanceState != null) {
            editTextFirstName.setText(savedInstanceState.getString(KEY_FIRST_NAME));
            editTextLastName.setText(savedInstanceState.getString(KEY_LAST_NAME));
        }

        // Inisialisasi EditText dan TextView untuk layout ketiga
        editTextFirstName = findViewById(R.id.editTextFirstName);
        editTextLastName = findViewById(R.id.editTextLastName);
        textViewFullName = findViewById(R.id.textViewFullName);

        // Menambahkan listener untuk EditText
        editTextFirstName.addTextChangedListener(textWatcher);
        editTextLastName.addTextChangedListener(textWatcher);
    }

    private final TextWatcher textWatcher = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {}

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {}

        @Override
        public void afterTextChanged(Editable s) {
            // Mengupdate TextView ketika teks di EditText berubah
            updateTextView();
        }
    };

    private void updateTextView() {
        String firstName = editTextFirstName.getText().toString();
        String lastName = editTextLastName.getText().toString();
        textViewFullName.setText(String.format("Full Name: %s %s", firstName, lastName));
    }

    @Override
    protected void onSaveInstanceState(@NonNull Bundle outState) {
        super.onSaveInstanceState(outState);
        // Menyimpan nilai dari kedua EditText saat orientasi perangkat berubah
        outState.putString(KEY_FIRST_NAME, editTextFirstName.getText().toString());
        outState.putString(KEY_LAST_NAME, editTextLastName.getText().toString());
    }
}