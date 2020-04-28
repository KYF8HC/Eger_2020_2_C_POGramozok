package com.example.cinemaapias.activities;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import com.example.cinemaapias.R;
import com.example.cinemaapias.fragments.HomeFragment;
import com.example.cinemaapias.fragments.MoviesFragment;
import com.example.cinemaapias.fragments.SettingsFragment;
import com.example.cinemaapias.fragments.UsersFragment;
import com.example.cinemaapias.models.User;
import com.example.cinemaapias.storage.SharedPreferenceManager;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class ProfileActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        BottomNavigationView navigationView = findViewById(R.id.bottom_nav);
        navigationView.setOnNavigationItemSelectedListener(this);
        displayFragment(new HomeFragment());
    }

    private void displayFragment(Fragment fragment) {
        getSupportFragmentManager()
                .beginTransaction()
                .replace(R.id.relativeLayout, fragment)
                .commit();
    }


    @Override
    protected void onStart() {
        super.onStart();

        if (!SharedPreferenceManager.getInstance(this).isLoggedIn()) {
            Intent intent = new Intent(this,
                    MainActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
        }
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        User user = SharedPreferenceManager.getInstance(this).getUser();
        Fragment fragment = null;

        if (user.getAccess() == 1) {
            switch (item.getItemId()) {
                case R.id.menu_home:
                    fragment = new HomeFragment();
                    break;
                case R.id.menu_users:
                    fragment = new UsersFragment();
                    break;
                case R.id.menu_settings:
                    fragment = new SettingsFragment();
                    break;
                case R.id.menu_movies:
                    fragment = new MoviesFragment();
                    break;
            }
            if (fragment != null) {
                displayFragment(fragment);
            }
        } else {
            switch (item.getItemId()) {
                case R.id.menu_home:
                    fragment = new HomeFragment();
                    break;
                case R.id.menu_settings:
                    fragment = new SettingsFragment();
                    break;
                case R.id.menu_movies:
                    fragment = new MoviesFragment();
                    break;
            }
            if (fragment != null) {
                displayFragment(fragment);
            }
        }
        return false;
    }
}
