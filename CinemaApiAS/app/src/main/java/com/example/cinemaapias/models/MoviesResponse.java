package com.example.cinemaapias.models;

import java.util.List;

public class MoviesResponse {

        private boolean error;
        private List<Movies> movies;

        public MoviesResponse(boolean error, List<Movies> movies) {
            this.error = error;
            this.movies = movies;
        }

        public boolean isError() {
            return error;
        }

        public List<Movies> getMovies() {
            return movies;
        }
    }
