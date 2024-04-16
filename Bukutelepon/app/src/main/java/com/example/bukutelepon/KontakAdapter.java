package com.example.bukutelepon;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class KontakAdapter
        extends RecyclerView.Adapter<RecyclerView.ViewHolder>
{

    private final Context context;
    private final List<Kontak> kontaks;

    public KontakAdapter(Context context, List<Kontak> kontaks){
        this.context = context;
        this.kontaks = kontaks;
    }
    public class VH extends RecyclerView.ViewHolder{

        private final TextView tvNama;
        private final TextView tvTelepon;

        public VH(@NonNull View itemView) {
            super(itemView);
            this.tvNama = itemView.findViewById(R.id.tvNama);
            this.tvTelepon = itemView.findViewById(R.id.tvTelepon);

        }
    }

    @NonNull
    @Override
    public RecyclerView.ViewHolder
    onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View vh = LayoutInflater.from(this.context)
                .inflate(R.layout.row_kontak,parent,false);
        return new VH(vh);
    }

    @Override
    public void onBindViewHolder(
            @NonNull RecyclerView.ViewHolder holder, int position) {
        Kontak k = this.kontaks.get(position);
        VH vh = (VH) holder;
        vh.tvTelepon.setText(k.telepon.toString());
        vh.tvNama.setText(k.nama.toString());
    }

    @Override
    public int getItemCount() {
        return this.kontaks.size();
    }
}