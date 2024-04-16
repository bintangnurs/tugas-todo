package com.example.kalkulator;


import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.MalformedURLException;
import java.net.URL;

import android.os.Bundle;
import android.os.Handler;
import android.os.Message;


import com.google.gson.Gson;

import javax.net.ssl.HttpsURLConnection;

public class SumThread extends Thread{
    private String x;
    private String y;
    private final Handler h;
    SumThread(String x, String y, Handler h){
        this.x=x;
        this.y=y;
        this.h =h;
    }
    @Override
    public void run() {
        super.run();
        try {
            URL url = new URL("https://mgm.ub.ac.id/sum.php");
            HttpsURLConnection conn = (HttpsURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setRequestProperty("User-Agent","App Guweh");
            conn.setRequestProperty("Accept","application/json");
            conn.setRequestProperty("Content-Type","application/json");
            conn.setDoOutput(true);

            //{"x":2,"y":3}
//            String dataToSend ="{"
//                    + "\"x\":" + this.x +","
//                    + "\"y\":" + this.y
//                    + "}";
            Gson gson = new Gson();
            Data d = new Data(this.x,this.y);
            String dataToSend =gson.toJson(d);

            OutputStream os = conn.getOutputStream();
            byte[] input =dataToSend.getBytes("utf-8");
            os.write(input,0, input.length);

            if(conn.getResponseCode()==200){
                //baca respon stream dari server
                //convert ke string
                InputStream is =conn.getInputStream();
                StringBuilder sb = new StringBuilder();
                BufferedReader br =new BufferedReader(
                        new InputStreamReader(is)
                );
                String line="";
                while((line=br.readLine())!=null) {
                    sb.append(line);
                }
                br.close();
                String hasilJson = sb.toString();
                Hasil hasil = gson.fromJson(hasilJson,Hasil.class);

                Message message = h.obtainMessage();
                Bundle bundle = new Bundle();
                bundle.putString("z",hasil.z);
                bundle.putInt("random",hasil.random);
                message.setData(bundle);
                h.sendMessage(message);
            }else{}

        } catch (Exception e) {}
    }
}