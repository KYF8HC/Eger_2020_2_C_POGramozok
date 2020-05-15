package com.example.cinemaapias.activities;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.cinemaapias.R;
import com.example.cinemaapias.api.RetrofitClient;
import com.example.cinemaapias.models.DefaultResponse;
import com.example.cinemaapias.storage.SharedPreferenceManager;


import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.graphics.Typeface;
import android.os.Bundle;
import android.text.SpannableString;
import android.text.style.StyleSpan;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.regex.Pattern;


public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private EditText editTextEmail, editTextPassword, editTextName;

    /* SeatSelection*/
    /*
    ArrayList<String> arrayList= new ArrayList<String>();
    ArrayList<String> arrayList1= new ArrayList<String>();
    SQLiteDatabase sql;
    DatabaseHelper db;
    ArrayList<ArrayList<String>> outer = new ArrayList<ArrayList<String>>();
    int seats_counter =0 ;
    Button A1,A2,A3,A4,A5,A6,A7,A8,A9,A10;
    Button B1,B2,B3,B4,B5,B6,B7,B8;
    Button C1,C2,C3,C4,C5,C6,C7,C8;
    Button D1,D2,D3,D4,D5,D6,D7,D8;
    String temp, temp1;
    int colorid;
    int flag=0;
    Bundle bundle;

    int movie;
    String date;
    String theatre;
    String time;
    String seats;*/

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        editTextEmail = findViewById(R.id.editTextEmail);
        editTextPassword = findViewById(R.id.editTextPassword);
        editTextName = findViewById(R.id.editTextName);

        findViewById(R.id.buttonSignUp).setOnClickListener(this);
        findViewById(R.id.textViewLogin).setOnClickListener(this);

         /*db = new DatabaseHelper(getApplicationContext());
        sql = db.getWritableDatabase();
        Toast toast = Toast.makeText(getApplicationContext(), "Confirmation Page", Toast.LENGTH_LONG);
        Intent intent = getIntent();
        Bundle seat_info = intent.getBundleExtra("seat_information");
        final String movie_id = intent.getStringExtra("movie_id");
        final String date1 = intent.getStringExtra("date");
        final String time1 = intent.getStringExtra("time");
        final String theatre1 = intent.getStringExtra("theatre");

        ArrayList<String> seating = seat_info.getStringArrayList("seats");
        ArrayList<String> total = seat_info.getStringArrayList("total");
        String movie_name = null;
        System.out.print(movie_id);
        String seat_number = total.get(0);

        System.out.println("The seat number value is" + seat_number);


        total_price = Integer.parseInt(seat_number) * 10;

        String price_final = "$" + Integer.toString(total_price);
        Cursor movie = db.getMoviename(sql, movie_id);

        while (movie.moveToNext()) {
            movie_name = movie.getString(0);

        }
        arr.add(0, movie_name);
        int len = seating.size();
        arr.add(1, theatre1);
        arr.add(2, date1);
        arr.add(3, time1);
        arr.add(4, price_final);

        final TextView seats = (TextView) findViewById(R.id.noofseats);
        final TextView theatre = (TextView) findViewById(R.id.theascr);
        TextView date = (TextView) findViewById(R.id.date);
        TextView time = (TextView) findViewById(R.id.time);
        TextView price = (TextView) findViewById(R.id.price);
        email = (EditText) findViewById(R.id.emailid);
        phone = (EditText) findViewById(R.id.phone);
        SpannableString styledString = new SpannableString(arr.get(0));
        styledString.setSpan(new StyleSpan(Typeface.BOLD), 0, arr.get(0).length(), 0);

        TextView tv = (TextView) findViewById(R.id.textView16);
        tv.setText(styledString);
        ImageView imageview = (ImageView) findViewById(R.id.imageView3);
        switch (Integer.parseInt(movie_id)) {
            case 1:
                imageview.setImageResource(R.drawable.images);
                break;
            case 2:
                imageview.setImageResource(R.drawable.mi55);
                break;
            case 3:
                imageview.setImageResource(R.drawable.avengers3);
                break;
            case 4:
                imageview.setImageResource(R.drawable.spiddy);
                break;
        }
        seats.setText("");
        for (int i = 0; i < len; i++) {
            seats.setText(seats.getText() + seating.get(i));
            if (i != len - 1) {
                seats.setText(seats.getText() + ",");
            }
        }
        theatre.setText(arr.get(1));
        time.setText(arr.get(3));
        date.setText(arr.get(2));
        price.setText(arr.get(4));
        final Bundle bundle = new Bundle();
        bundle.putString("movie_id", movie_id);
        bundle.putString("date", date1);
        bundle.putBundle("seat_information", seat_info);
        bundle.putString("time", time1);
        bundle.putString("theatre", theatre1);

        bundle.putString("price", price.getText().toString());
        Button bktkt = (Button) findViewById(R.id.pay);
        bktkt.setOnClickListener(new View.OnClickListener(); */

        /* SeatSelection */
        /*
        A1 = (Button) findViewById(R.id.A1);
        A2 = (Button) findViewById(R.id.A2);
        A3 = (Button) findViewById(R.id.A3);
        A4 = (Button) findViewById(R.id.A4);
        A5 = (Button) findViewById(R.id.A5);
        A6 = (Button) findViewById(R.id.A6);

        Bundle b = getIntent().getExtras();
        movie = b.getInt("movie_id");
        date = b.getString("date");
        theatre = b.getString("theatre");
        time = b.getString("time");
        int j=0;
        String seating="";
        System.out.print(theatre);

        Cursor seatnos = db.getseats(sql,theatre, date, time,movie);
        System.out.print("   " + seatnos.getCount());

        if(seatnos !=null && seatnos.getCount() >0) {
            System.out.print(seating);
            while (seatnos.moveToNext()) {
                if ( j==0) {
                    seating = seatnos.getString(0);

                } else if (seatnos.getCount() >1) {
                    seating = seating + ',';
                    if (!seatnos.isLast()) {
                        seating = seating + seatnos.getString(0);
                    } else {
                        seating = seating + seatnos.getString(0);
                    }
                }
                j++;
            }

            System.out.print(" " + seating);
            List<String> seats_booked = Arrays.asList(seating.split(","));


            for (int i = 0; i < seats_booked.size(); i++) {
                System.out.println("Split String: " + seats_booked.get(i));
                if ("A1".equals(seats_booked.get(i))) {
                    A1.setBackgroundColor(Color.parseColor("#A45B5B"));
                } else if ("A2".equals(seats_booked.get(i))) {
                    A2.setBackgroundColor(Color.parseColor("#A45B5B"));
                } else if ("A3".equals(seats_booked.get(i))) {
                    A3.setBackgroundColor(Color.parseColor("#A45B5B"));
                } else if ("A4".equals(seats_booked.get(i))) {
                    A4.setBackgroundColor(Color.parseColor("#A45B5B"));
                } else if ("A5".equals(seats_booked.get(i))) {
                    A5.setBackgroundColor(Color.parseColor("#A45B5B"));
                } else if ("A6".equals(seats_booked.get(i))) {
                    A6.setBackgroundColor(Color.parseColor("#A45B5B"));

            }
        }
        else
        {
            System.out.print("no print");
        }
        A1.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {

                ColorDrawable buttonColor = (ColorDrawable) A1.getBackground();
                colorid= buttonColor.getColor();

                if(colorid==(-1654272)) {
                    System.out.println("I am in selected seat");
                    A1.setBackgroundColor(Color.parseColor("#87A96B"));
                    seats_counter++;
                    arrayList.add("A1");
                }
                else if(colorid== (-6005925)){
                    System.out.println("This seat is already booked");
                    Toast toast= Toast.makeText(getApplicationContext(),"Sorry, this seat is already booked.",Toast.LENGTH_SHORT);
                    toast.show();
                }
                else if(colorid== (-7886485)){
                    System.out.println("This seat is unselected");
                    A1.setBackgroundColor(Color.parseColor("#E6C200"));
                    seats_counter--;
                    arrayList.remove("A1");
                }
            }
        });

            A2.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v) {

                    ColorDrawable buttonColor = (ColorDrawable) A2.getBackground();
                    colorid= buttonColor.getColor();

                    if(colorid==(-1654272)) {
                        A2.setBackgroundColor(Color.parseColor("#87A96B"));
                        seats_counter++;
                        arrayList.add("A2");
                        System.out.println("The seats are :"+ arrayList);
                    }
                    else if(colorid== (-6005925)){
                        Toast toast= Toast.makeText(getApplicationContext(),"Sorry, this seat is already booked.",Toast.LENGTH_SHORT);
                        toast.show();
                    }
                    else if(colorid== (-7886485)){
                        A2.setBackgroundColor(Color.parseColor("#E6C200"));
                        seats_counter--;
                        arrayList.remove("A2");
                    }
                }
            });

            A3.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v) {

                    ColorDrawable buttonColor = (ColorDrawable) A3.getBackground();
                    colorid= buttonColor.getColor();

                    if(colorid==(-1654272)) {
                        A3.setBackgroundColor(Color.parseColor("#87A96B"));
                        seats_counter++;
                        arrayList.add("A3");

                    }
                    else if(colorid== (-6005925)){
                        Toast toast= Toast.makeText(getApplicationContext(),"Sorry, this seat is already booked.",Toast.LENGTH_SHORT);
                        toast.show();
                    }
                    else if(colorid== (-7886485)){

                        A3.setBackgroundColor(Color.parseColor("#E6C200"));
                        seats_counter--;
                        arrayList.remove("A3");
                    }
                }
            });

            A4.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v) {

                    ColorDrawable buttonColor = (ColorDrawable) A4.getBackground();
                    colorid= buttonColor.getColor();

                    if(colorid==(-1654272)) {
                        A4.setBackgroundColor(Color.parseColor("#87A96B"));
                        seats_counter++;
                        arrayList.add("A4");
                    }
                    else if(colorid== (-6005925)){
                        Toast toast= Toast.makeText(getApplicationContext(),"Sorry, this seat is already booked.",Toast.LENGTH_LONG);
                        toast.show();
                    }
                    else if(colorid== (-7886485)){
                        A4.setBackgroundColor(Color.parseColor("#E6C200"));
                        seats_counter--;
                        arrayList.remove("A4");
                    }
                }
            });

            A5.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v) {

                    ColorDrawable buttonColor = (ColorDrawable) A5.getBackground();
                    colorid= buttonColor.getColor();

                    if(colorid==(-1654272)) {
                        A5.setBackgroundColor(Color.parseColor("#87A96B"));
                        seats_counter++;
                        arrayList.add("A5");

                    }
                    else if(colorid== (-6005925)){
                        Toast toast= Toast.makeText(getApplicationContext(),"Sorry, this seat is already booked.",Toast.LENGTH_SHORT);
                        toast.show();
                    }
                    else if(colorid== (-7886485)){

                        A5.setBackgroundColor(Color.parseColor("#E6C200"));
                        seats_counter--;
                        arrayList.remove("A5");
                    }
                }
            });

            A6.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v) {

                    ColorDrawable buttonColor = (ColorDrawable) A6.getBackground();
                    colorid= buttonColor.getColor();

                    if(colorid==(-1654272)) {
                        A6.setBackgroundColor(Color.parseColor("#87A96B"));
                        seats_counter++;
                        arrayList.add("A6");
                    }
                    else if(colorid== (-6005925)){
                        Toast toast= Toast.makeText(getApplicationContext(),"Sorry, this seat is already booked.",Toast.LENGTH_SHORT);
                        toast.show();
                    }
                    else if(colorid== (-7886485)){
                        A6.setBackgroundColor(Color.parseColor("#E6C200"));
                        seats_counter--;
                        arrayList.remove("A6");
                    }
                }
            });
    }
    }

    public void counter(){

        int size ;

        if(flag==0){
            temp= Integer.toString(seats_counter);
            arrayList1.add(temp);
            outer.add(arrayList1);
            flag=1;
        }
        else{
            size = arrayList1.size();
            String get_currval = arrayList1.get(size-1);
            arrayList1.remove(get_currval);
            temp= Integer.toString(seats_counter);
            arrayList1.add(temp);
            outer.add(arrayList1);
        }
    }
         */
    @Override
    protected void onStart() {
        super.onStart();
        if (SharedPreferenceManager.getInstance(this).isLoggedIn()) {
            Intent intent = new Intent(this,
                    ProfileActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
        }
    }

    private void userSignUp() {
        String email = editTextEmail.getText().toString().trim();
        String password = editTextPassword.getText().toString().trim();
        String name = editTextName.getText().toString().trim();
        int access = 2;

        if (email.isEmpty()) {
            editTextEmail.setError("Email is required");
            editTextEmail.requestFocus();
            return;
        }
        if (!Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            editTextEmail.setError("Enter a valid email");
            editTextEmail.requestFocus();
            return;
        }
        if (password.isEmpty()) {
            editTextPassword.setError("Password required");
            editTextPassword.requestFocus();
            return;
        }
        if (password.length() < 6) {
            editTextPassword.setError("Password should be at least 6 character long");
            editTextPassword.requestFocus();
            return;
        }
        if (name.isEmpty()) {
            editTextName.setError("Name required");
            editTextName.requestFocus();
            return;
        }
        Call<DefaultResponse> call = RetrofitClient
                .getInstance()
                .getApi()
                .createUser(email, password, name, access);
        call.enqueue(new Callback<DefaultResponse>() {
            @Override
            public void onResponse(Call<DefaultResponse> call, Response<DefaultResponse> response) {
                if (response.code() == 201) {
                    DefaultResponse dr = response.body();
                    Toast.makeText(MainActivity.this,
                            dr.getMsg(),
                            Toast.LENGTH_LONG).show();
                } else if (response.code() == 422) {
                    Toast.makeText(MainActivity.this,
                            "User already exist!",
                            Toast.LENGTH_LONG).show();
                } else if (response.code() == 423) {
                    Toast.makeText(MainActivity.this,
                            "Some error occurred!!",
                            Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<DefaultResponse> call, Throwable t) {
            }
        });
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.buttonSignUp:
                userSignUp();
                break;
            case R.id.textViewLogin:
                startActivity(new Intent(this, LoginActivity.class));
                break;
        }
        /*
        if (!ValidEmailId(email.getText().toString().trim()) || (phone.getText().toString().length() != 10)) {
            Toast.makeText(getApplicationContext(), "Email/Phone number not valid", Toast.LENGTH_SHORT).show();
        } else {
            final String Email = email.getText().toString();
            final String phoneno = phone.getText().toString();

            final Dialog dialog = new Dialog(context);
            dialog.setContentView(R.layout.activity_user_information);
            WindowManager.LayoutParams params = dialog.getWindow().getAttributes();
            params.width = WindowManager.LayoutParams.FILL_PARENT;
            dialog.getWindow().setAttributes((WindowManager.LayoutParams) params);
            final EditText namecard = (EditText) dialog.findViewById(R.id.nameoncard);
            final EditText creditcard = (EditText) dialog.findViewById(R.id.creditcard);
            final EditText cvvno = (EditText) dialog.findViewById(R.id.cvv);
            final EditText valid = (EditText) dialog.findViewById(R.id.vt1);
            final EditText valid1 = (EditText) dialog.findViewById(R.id.vt2);

            Button order = (Button) dialog.findViewById(R.id.completeorder);
            order.setText("Complete Order ( Total " + arr.get(4) + ")");
            order.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    ArrayList<String> reversedarry = new ArrayList<String>();
                    if ((namecard.getText().toString().isEmpty()) || (creditcard.getText().toString().isEmpty()) || (cvvno.getText().toString().isEmpty()) || (valid.getText().toString().isEmpty())) {
                        Toast.makeText(getApplicationContext(), "Please insert the data", Toast.LENGTH_SHORT).show();
                    } else {
                        int booking_id = 0;
                        Log.d("phone no", phoneno);
                        Cursor max = db.getmaxbooking(sql);
                        if (max != null && max.getCount() > 0) {
                            while (max.moveToNext()) {
                                maximum = max.getInt(0);
                            }
                        }
                        if (db.insertmoviebooked(Integer.parseInt(movie_id), seats.getText().toString(), theatre1, time1, date1, 10, Email, phoneno)) {

                            Intent intent;
                            intent = new Intent(context, MovieConfirmation.class);
                            intent.putExtra("booking_id", (maximum + 1));
                            context.startActivity(intent);
                        } else {
                            Toast.makeText(getApplicationContext(), "Error in Movie Booking. Please try again", Toast.LENGTH_LONG).show();
                        }
                    }
                }
            });
            dialog.show();
        }
         */
    }
    /*
    private boolean ValidEmailId(String email){

        return Pattern.compile("^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
                + "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                + "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
                + "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                + "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
                + "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$").matcher(email).matches();
    }
    */
}