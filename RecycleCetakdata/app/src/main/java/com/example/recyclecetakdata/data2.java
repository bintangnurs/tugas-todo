package com.example.recyclecetakdata;

import java.util.ArrayList;

public class data2 {
    private static String [] personname = {
      "Bintang",
      "Dava",
      "Titan",
      "Gandi",
      "Kamal",
            "daud",
            "ipeh",
            "farrel",
            "juno",
            "samsul",
            "nur",
    };
    private static String [] detail = {
          "Bintang telah absen pada tanggal 15 april 2024",
            "Dava telah absen pada tanggal 15 april 2024",
            "Titan telah absen pada tanggal 15 april 2024",
            "Gandi telah absen pada tanggal 15 april 2024",
            "Kamal telah absen pada tanggal 15 april 2024",
            "daud telah absen pada tanggal 15 april 2024",
            "ipeh telah absen pada tanggal 15 april 2024",
            "farrel telah absen pada tanggal 15 april 2024",
            "juno telah absen pada tanggal 15 april 2024",
            "samsul telah absen pada tanggal 15 april 2024",
            "nur telah absen pada tanggal 15 april 2024",

    };

    private static int[] personimage = {
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
            R.drawable.bintang,
    };

    static ArrayList<data> getListData(){
        ArrayList<data> list=new ArrayList<>();
        for (int position = 0; position < personname.length; position++){
            data data = new data();
            data.setName(personname[position]);
            data.setDetail(detail[position]);
            data.setPhoto(String.valueOf(personimage[position]));

            list.add(data);

        }
        return list;
    }
}
