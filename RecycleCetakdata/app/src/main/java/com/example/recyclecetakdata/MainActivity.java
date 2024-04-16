package com.example.recyclecetakdata;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    private RecyclerView rvdata;
    private ArrayList<data> list = new ArrayList<>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        rvdata = findViewById(R.id.rv_data);
        rvdata.setHasFixedSize(true);

        list.addAll(data2.getListData());
        showRecyclerList();
    }
    private void showRecyclerList(){
        rvdata.setLayoutManager(new LinearLayoutManager(this));
        ListDataAdapter listDataAdapter = new ListDataAdapter(list);
        rvdata.setAdapter(listDataAdapter);

    }
}