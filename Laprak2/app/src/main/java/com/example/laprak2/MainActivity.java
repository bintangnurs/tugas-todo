package com.example.laprak2;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;
public class MainActivity extends AppCompatActivity {
    private EditText firstNameEdit;
    private EditText lastNameEdit;
    private TextView textContent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        firstNameEdit = findViewById(R.id.firstNameEdit);
        lastNameEdit = findViewById(R.id.lastNameEdit);
        textContent = findViewById(R.id.textContent);
        Button saveButton = findViewById(R.id.saveButton);
        saveButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                displayFullName();
            }
        });
    }
    private void displayFullName() {
        String firstName =
                firstNameEdit.getText().toString();
        String lastName =
                lastNameEdit.getText().toString();
        String fullName = "Nama: " + firstName + " " +
                lastName;
        textContent.setText(fullName);
    }
    @Override
    protected void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        outState.putString("firstName",
                firstNameEdit.getText().toString());
        outState.putString("lastName",
                lastNameEdit.getText().toString());
    }
    @Override
    protected void onRestoreInstanceState(Bundle
                                                  savedInstanceState) {
        super.onRestoreInstanceState(savedInstanceState);
        String firstName =
                savedInstanceState.getString("firstName");
        String lastName =
                savedInstanceState.getString("lastName");
        firstNameEdit.setText(firstName);
        lastNameEdit.setText(lastName);
        displayFullName();
    }
}