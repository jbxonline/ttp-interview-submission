<?php

class Widget extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'widgets';

    protected $fillable = ['name', 'color', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
