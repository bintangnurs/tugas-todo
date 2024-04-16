package com.example.daducoba;

import android.os.Bundle;
import android.os.Handler;
import android.os.Message;

public class DaduThread extends Thread{

    Handler uiHandler;
    Runnable runnable;
    int angka = 1;

    DaduThread(Handler uiHandler){
        this.uiHandler = uiHandler;
        this.runnable = new Runnable() {
            @Override
            public void run() {
                // kode yang dijalankan disini
                // diproses di background thread
                try {
                    while (true) {
                        angka = (int) Math.ceil(Math.random() * 2);
                        Bundle bundle = new Bundle();
                        bundle.putInt("angka", angka);
                        Message message = uiHandler.obtainMessage();
                        message.setData(bundle);
                        uiHandler.sendMessage(message);
                        Thread.sleep(100);
                    }
                } catch (Exception e){}
            }
        };
    }

    @Override
    public void run() {
        super.run();
        this.runnable.run();
    }
}