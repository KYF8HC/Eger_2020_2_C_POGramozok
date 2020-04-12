package com.example.cinemaapias;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class Client {
    private static final String BaseURL = "https://192.168.0.16/CinemaAPI/public";
    private static Client mInstance;
    private Retrofit retrofit;

    private Client(){
        retrofit =  new Retrofit.Builder()
                .baseUrl(BaseURL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();
    }

    public static synchronized Client getInstance(){
        if(mInstance == null){
            mInstance = new Client();
        }
        return  mInstance;
    }

    public API getApi(){
        return  retrofit.create(API.class);
    }

}
