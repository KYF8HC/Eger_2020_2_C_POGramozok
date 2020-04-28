package com.example.cinemaapias.storage;

import android.content.Context;
import android.content.SharedPreferences;

import com.example.cinemaapias.models.User;

public class SharedPreferenceManager {

    private static final String SHARED_PREF_NAME = "my_shared_preff";

    private static SharedPreferenceManager mInstance;
    private Context mCtx;

    private SharedPreferenceManager(Context mCtx) {
        this.mCtx = mCtx;
    }

    public static synchronized SharedPreferenceManager getInstance(Context mCtx){
        if(mInstance == null){
            mInstance = new SharedPreferenceManager(mCtx);
        }
        return mInstance;
    }

    public void saveUser(User user){
        SharedPreferences sharedPreferences =
                mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putInt("id", user.getId());
        editor.putString("email", user.getEmail());
        editor.putString("name", user.getName());
        editor.putInt("access", user.getAccess());

        editor.apply();
    }
    public boolean isLoggedIn() {
        SharedPreferences sharedPreferences =
                mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getInt("id", -1) != -1;
    }
    public User getUser(){
        SharedPreferences sharedPreferences =
                mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return new User(
                sharedPreferences.getInt("id", -1),
                sharedPreferences.getInt("access", -1),
                sharedPreferences.getString("email", null),
                sharedPreferences.getString("name", null)
        );
    }
    public void clear(){
        SharedPreferences sharedPreferences =
                mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
    }
}
