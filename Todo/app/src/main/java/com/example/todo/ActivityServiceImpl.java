package com.example.todo;

import java.util.ArrayList;
import java.util.List;

public class ActivityServiceImpl implements ActivityService {
    @Override
    public List<Activity> getActivities() {
        List<Activity> activities = new ArrayList<>();
        activities.add(new Activity(1, "Pray", "04:10"));
        activities.add(new Activity(2, "Breakfast", "06:10"));
        activities.add(new Activity(3, "Study", "08:40"));
        activities.add(new Activity(4, "Lunch", "11:59"));
        activities.add(new Activity(5, "Play", "13:25"));
        activities.add(new Activity(6, "Poo", "18:00"));
        activities.add(new Activity(7, "Sleep", "21:10"));
        return activities;
}
}