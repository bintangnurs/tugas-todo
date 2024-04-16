package com.example.retrofit;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;

public interface ActivityService {
    List<Activity> getActivities();
}