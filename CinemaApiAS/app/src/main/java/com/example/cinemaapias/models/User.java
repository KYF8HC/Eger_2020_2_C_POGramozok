package com.example.cinemaapias.models;

public class User {

    private int id;
    private String email, name;
    private int access;

    public User(int id, String email, String name, int access) {
        this.id = id;
        this.email = email;
        this.name = name;
        this.access = access;
    }

    public int getId() {
        return id;
    }

    public String getEmail() {
        return email;
    }

    public String getName() {
        return name;
    }

    public int getAccess() {
        return access;
    }
}