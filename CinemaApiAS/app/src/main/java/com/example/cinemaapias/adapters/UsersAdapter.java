package com.example.cinemaapias.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.cinemaapias.R;
import com.example.cinemaapias.models.User;

import java.util.List;

public class UsersAdapter extends RecyclerView.Adapter<UsersAdapter.UsersViewHolder>  {
    private Context mCtx;
    private List<User> userList;

    public UsersAdapter(Context mCtx, List<User> userList) {
        this.mCtx = mCtx;
        this.userList = userList;
    }

    @NonNull
    @Override
    public UsersAdapter.UsersViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(mCtx).inflate(R.layout.recylerview_users, parent, false);
        return new UsersAdapter.UsersViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull UsersAdapter.UsersViewHolder holder, int position) {
        User user = userList.get(position);

        holder.textViewName.setText(user.getName());
        holder.textViewEmail.setText(user.getEmail());
    }

    @Override
    public int getItemCount() {
        return userList.size();
    }

     class UsersViewHolder extends RecyclerView.ViewHolder{
        TextView textViewName, textViewEmail;

        public UsersViewHolder(@NonNull View itemView) {
            super(itemView);

            textViewName = itemView.findViewById(R.id.textViewName);
            textViewEmail = itemView.findViewById(R.id.textViewEmail);
        }
    }
}
