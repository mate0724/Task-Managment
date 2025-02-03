<?php

return [
    'name' => 'Név',
    'email' => 'E-mail',
    'job_title' => 'Munkakör',
    'actions' => 'Műveletek',
    'edit' => 'Szerkesztés',
    'delete' => 'Törlés',
    'search' => 'Keresés',
    'export' => 'Exportálás',
    'add_user' => 'Felhasználó hozzáadása',
    'users_list' => 'Felhasználók listája',

    //dashboard.blade.php
    'welcome' => 'Üdvözlünk az alkalmazásban!',
    'greetings' => [
        'morning' => 'Jó reggelt!',
        'afternoon' => 'Jó napot!',
        'evening' => 'Jó estét!',
        'night' => 'Jó éjszakát!',
    ],


    //groups.index.php
    'groups' => 'Csoportjaim',
    'add' => 'Csoport hozzáadása',
    'no_groups' => 'Nincsenek csoportjaid',
    'description' => 'Leírás',
    'group_leader' => 'Csoportvezető',
    'members' => 'Tagok',


    //groups.create.php
    'create_group' => 'Csoport létrehozása',
    'group_name' => 'Csoport neve',
    'save' => 'Mentés',
    'create' => 'Létrehozás',


    //groups.edit.php
    'edit_group' => 'Edit Group',

    //users.edit.php
    'edit_user' => 'Felhasználó szerkesztése',
    'update' => 'Frissítés',

    //users.create.php
    'create_user' => 'Felhasználó létrehozása',
    'password' => 'Jelszó',
    'confirm_password' => 'Jelszó megerősítése',


    //meetings.index.php
    'my_meetings' => 'Értekezleteim',
    'upcoming_meetings' => 'Közelgő értekezletek',
    'create_meeting' => 'Értekezlet létrehozása',

    //meetings.create.php
    'create_new_meeting' => 'Új értekezlet létrehozása',
    'title' => 'Cím',
    'scheduled_at' => 'Időpont',
    'location' => 'Helyszín',
    'attendees' => 'Résztvevők',
    'multiple_attendees' => 'Több résztvevő kiválasztásához tartsd lenyomva a Ctrl (Windows) vagy Command (Mac) gombot.',

    //tasks.index.php
    'group' => 'Csoport: ',
    'tasks' => 'Feladatok',
    'create_task' => 'Új feladat létrehozása',
    'priority' => 'Prioritás',
    'deadline' => 'Határidő',
    'status' => 'Státusz',
    'file' => 'Csatolt fájl',
    'comments' => 'Megjegyzések',

    //tasks.create.php
    'create_new_task' => 'Új feladat létrehozása',
    'optional' => 'Opcionális',
    'in_progress' => 'Folyamatban',
    'completed' => 'Befejezett',
    'low' => 'Alacsony',
    'medium' => 'Közepes',
    'high' => 'Magas',

    //tasks.show.php
    'view_task' => 'Feladat megtekintése',
    'comment' => 'Hozzászólás',
    'write_comment' => 'Írj egy kommentet...',

    //navigation.blade.php
    'home' => 'Főoldal',
    'users' => 'Felhasználók',
    'meetings' => 'Értekezletek',

    //tasks.edit.php
    'edit_task' => 'Feladat szerkesztése',
    'cancel' => 'Mégse',
    'upload_file' => 'Fájl feltöltése',

];
