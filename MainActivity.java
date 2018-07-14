package com.example.haasikapuram.yfs;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;

public class MainActivity extends AppCompatActivity {
ImageView imageView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        imageView=(ImageView)findViewById(R.id.img);
        Thread myThread=new Thread(){
            @Override
            public void run() {
                try{


                    sleep(800);
                    Intent i=new Intent(getApplicationContext(),About.class);
                    startActivity(i);
                    finish();
                }catch(InterruptedException e){
                    e.printStackTrace();
                }

            }
        };
        myThread.start();
    }
}
