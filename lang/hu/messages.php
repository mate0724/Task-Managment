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
    'users_list' => 'Munkatársak listája',

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
    'no_tasks' => 'Nincsenek még feladataid.',


    //groups.create.php
    'create_group' => 'Csoport létrehozása',
    'group_name' => 'Csoport neve',
    'save' => 'Mentés',
    'create' => 'Létrehozás',


    //groups.edit.php
    'edit_group' => 'Csoport szerkesztése',

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
    'no_meetings' => 'Nem találhatók értekezletek.',

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
    'hide_expired_tasks' => 'Lejárt feladatok elrejtése',
    'show_expired_tasks' => 'Lejárt feladatok megjelenítése',
    'expired' => '(Lejárt)',
    'today' => '(Ma)',

    //tasks.create.php
    'create_new_task' => 'Új feladat létrehozása',
    'optional' => 'Opcionális',
    'to_do' => 'Teendő',
    'in_progress' => 'Folyamatban',
    'completed' => 'Befejezett',
    'low' => 'Alacsony',
    'medium' => 'Közepes',
    'high' => 'Magas',
    'all' => 'Összes',

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


    'language' => 'Nyelvek',
    'english' => 'Angol',
    'spanish' => 'Spanyol',
    'french' => 'Francia',
    'german' => 'Német',
    'hungarian' => 'Magyar',

    //profil
    'profile' => 'Profil',
    'profile_information' => 'Profil információk',
    'acc_update' => 'Frissítse fiókja adatait és e-mail címét.',
    'unverifed' => 'Az e-mail címe nincs megerősítve.',
    'verification' => 'Kattintson ide a megerősítő e-mail újraküldéséhez.',
    'new_verifications' => 'Új megerősítő hivatkozást küldtünk az e-mail címére.',

    'acc_delete' => 'Fiók törlése',
    'del_warning' => 'A fiók törlése után annak összes erőforrása és adata véglegesen törlődik. Mielőtt törölné fiókját, kérjük, töltse le azokat az adatokat vagy információkat, amelyeket meg szeretne tartani.',
    'del_conf' => 'Biztosan törölni szeretné a fiókját?',
    'password_confirm_warning' => 'A fiók törlése után annak összes erőforrása és adata véglegesen törlődik. Kérjük, adja meg jelszavát annak megerősítéséhez, hogy véglegesen törölni kívánja fiókját.',


    'update_password' => 'Jelszó frissítése',
    'password_warning' => 'A biztonság érdekében győződjön meg arról, hogy fiókja hosszú, véletlenszerű jelszót használ.',
    'current_password' => 'Jelenlegi jelszó',
    'new_password' => 'Új jelszó',
    'saved' => 'Mentve.',

    'welcome_groups' => 'Üdvözlünk a Csoportkezelő felületen! Itt láthatod az összes csoportodat, amelyeknek tagja vagy. A táblázatban megtalálod a partnereidet, a csoport vezetőjét és minden fontos információt. Kattints egyszerűen a csoport nevére a hozzá tartozó feladatok megtekintéséhez.',

    'remember_me' => 'Emlékezz rám',
    'login' => 'Bejelentkezés',

    'group_created' => 'Új csoport jött létre: :name',
    'meeting_created' => 'Új értekezlet jött létre: :title',
    'task_created' => 'Új feladat jött létre: :title',
    'task_due_today' => "A(z) ':title' feladat határideje ma van!",
    'task_updated' => "A(z) ':title' feladat frissítve lett!",

    'view_all' => 'Összes megtekintése',


];
