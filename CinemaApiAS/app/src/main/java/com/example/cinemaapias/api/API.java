package com.example.cinemaapias.api;

import com.example.cinemaapias.models.DefaultResponse;
import com.example.cinemaapias.models.LoginResponse;
import com.example.cinemaapias.models.MoviesResponse;
import com.example.cinemaapias.models.UsersResponse;

import retrofit2.Call;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

public interface API {

        @FormUrlEncoded
        @POST("createuser")
        Call<DefaultResponse> createUser(
                @Field("email") String email,
                @Field("password") String password,
                @Field("name") String name,
                @Field("access") int access
        );

        @FormUrlEncoded
        @POST("userlogin")
        Call<LoginResponse> userLogin(
                @Field("email") String email,
                @Field("password") String password
        );

        @GET("allusers")
        Call<UsersResponse> getUsers();

        @GET("allmovies")
        Call<MoviesResponse> getMovies();

        @FormUrlEncoded
        @PUT("updateuser/{id}")
        Call<LoginResponse> updateUser(
                @Path("id") int id,
                @Field("email") String email,
                @Field("name") String name,
                @Field("access") int access
        );

        /*@FormUrlEncoded
        @PUT("updatepassword")
        Call<DefaultResponse> updatePassword(
                @Field("currentpassword") String currentpassword,
                @Field("newpassword") String newpassword,
                @Field("email") String email
        );*/

        @DELETE("deleteuser/{id}")
        Call<DefaultResponse> deleteUser(@Path("id") int id);

}