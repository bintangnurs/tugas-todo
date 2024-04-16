package com.example.recyclecetakdata;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;



import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;

public class ListDataAdapter extends  RecyclerView.Adapter<ListDataAdapter.ListViewHolder> {
    private ArrayList<data> listdata;
    public ListDataAdapter(ArrayList<data> list) {
        this.listdata = list;
    }
    @NonNull
    @Override
    public ListViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_row_data, parent, false);
        return new ListViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ListViewHolder holder, int position) {
        data data =listdata.get(position);
        Glide.with(holder.itemView.getContext())
                .load(data.getPhoto())
                .apply(new RequestOptions(). override(55, 55))
                .into(holder.imgPhoto);
        holder.tv_item_nama.setText(data.getName());
        holder.tv_item_keterangan.setText(data.getDetail());


    }

    @Override
    public int getItemCount() {
        return listdata.size();
    }


    public class ListViewHolder extends RecyclerView.ViewHolder {
        ImageView imgPhoto;
        TextView tv_item_nama;
        TextView tv_item_keterangan;
        public ListViewHolder(View itemview) {
            super(itemview);
            imgPhoto = itemview.findViewById(R.id.img_item_person);
            tv_item_nama = itemview.findViewById(R.id.tv_item_nama);
            tv_item_keterangan = itemview.findViewById(R.id.tv_item_keterangan);
        }
    }
}
