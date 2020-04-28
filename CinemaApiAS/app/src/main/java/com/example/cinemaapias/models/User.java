package com.example.cinemaapias.models;

public class User {

    private int id, access;
    private String email, name;

    public User(int id, int access, String email, String name) {
        this.id = id;
        this.access = access;
        this.email = email;
        this.name = name;
    }

    public int getId() {
        return id;
    }

    public int getAccess() {
        return access;
    }

    public String getEmail() {
        return email;
    }

    public String getName() {
        return name;
    }
}
