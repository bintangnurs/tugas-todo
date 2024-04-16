package com.example.bukutelepon;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.view.View;

import java.sql.Array;
import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {


    private List<Kontak> data;
    private RecyclerView rvKontak;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        
        this.data = new ArrayList<Kontak>();
        
        Kontak a = new Kontak( "djoko",  "089635754969");
        Kontak b = new Kontak( "jamal",  "089511227");
       
        this.data.add(a); this.data.add(a); this.data.add(a);
        this.data.add(b); this.data.add(b); this.data.add(b);
        this.data.add(a); this.data.add(a); this.data.add(a);
        this.data.add(b); this.data.add(b); this.data.add(b);
        
        this.rvKontak = this.findViewById(R.id.rvKontak);
        KontakAdapter kontakAdapter = new KontakAdapter(MainActivity.this, this.data);

        RecyclerView.LayoutManager lm = new LinearLayoutManager(MainActivity.this);

        this.rvKontak.setLayoutManager(lm);
        this.rvKontak.setAdapter(kontakAdapter);
    }
}