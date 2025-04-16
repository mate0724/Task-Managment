<?php

return [
    'name' => 'Nombre',
    'email' => 'Correo electrónico',
    'job_title' => 'Título del trabajo',
    'actions' => 'Acciones',
    'edit' => 'Editar',
    'delete' => 'Eliminar',
    'search' => 'Buscar',
    'export' => 'Exportar',
    'add_user' => 'Agregar usuario',
    'users_list' => 'Lista de usuarios',

    //dashboard.blade.php
    'welcome' => '¡Bienvenido a la aplicación!',
    'greetings' => [
        'morning' => '¡Buenos días!',
        'afternoon' => '¡Buenas tardes!',
        'evening' => '¡Buenas noches!',
        'night' => '¡Buenas noches!',
    ],

    //groups.index.php
    'groups' => 'Mis Grupos',
    'add' => 'Agregar Grupo',
    'no_groups' => 'No hay grupos.',
    'description' => 'Descripción',
    'group_leader' => 'Líder del Grupo',
    'members' => 'Miembros',

    //groups.create.php
    'create_group' => 'Crear Grupo',
    'group_name' => 'Nombre del Grupo',
    'save' => 'Guardar',
    'create' => 'Crear',

    //groups.edit.php
    'edit_group' => 'Editar Grupo',

    //users.edit.php
    'edit_user' => 'Editar Usuario',
    'update' => 'Actualizar',

    //users.create.php
    'create_user' => 'Crear Usuario',
    'password' => 'Contraseña',
    'confirm_password' => 'Confirmar Contraseña',

    //meetings.index.php
    'my_meetings' => 'Mis Reuniones',
    'upcoming_meetings' => 'Próximas Reuniones',
    'create_meeting' => 'Crear Reunión',
    'no_meetings' => 'No se encontraron reuniones.',
    //meetings.create.php
    'create_new_meeting' => 'Crear Nueva Reunión',
    'title' => 'Título',
    'scheduled_at' => 'Programado para',
    'location' => 'Ubicación',
    'attendees' => 'Participantes',
    'multiple_attendees' => 'Mantenga presionada la tecla Ctrl (Windows) o Comando (Mac) para seleccionar múltiples participantes.',

    //tasks.index.php
    'group' => 'Grupo: ',
    'tasks' => 'Tareas',
    'create_task' => 'Crear Nueva Tarea',
    'priority' => 'Prioridad',
    'deadline' => 'Fecha límite',
    'status' => 'Estado',
    'file' => 'Archivo Adjunto',
    'comments' => 'Comentarios',
    'hide_expired_tasks' => 'Ocultar Tareas Vencidas',
    'show_expired_tasks' => 'Mostrar Tareas Vencidas',
    'expired' => '(Vencida)',
    'today' => '(Hoy)',

    //tasks.create.php
    'create_new_task' => 'Crear Nueva Tarea',
    'optional' => 'Opcional',
    'to_do' => 'Por Hacer',
    'in_progress' => 'En Progreso',
    'completed' => 'Completado',
    'low' => 'Baja',
    'medium' => 'Media',
    'high' => 'Alta',

    //tasks.edit.php
    'edit_task' => 'Editar Tarea',
    'cancel' => 'Cancelar',
    'upload_file' => 'Subir Archivo',

    //tasks.show.php
    'view_task' => 'Ver Tarea',
    'comment' => 'Comentario',
    'write_comment' => 'Escriba un comentario...',

    //navigation.blade.php
    'home' => 'Inicio',
    'users' => 'Usuarios',
    'meetings' => 'Reuniones',

    'language' => 'Idioma',
    'english' => 'Inglés',
    'spanish' => 'Español',
    'french' => 'Francés',
    'german' => 'Alemán',
    'hungarian' => 'Húngaro',

    'no_tasks' => 'No hay tareas todavía.',

    'all' => 'Todos',

    //profil
    'profile' => 'Perfil',
    'profile_information' => 'Información del Perfil',
    'acc_update' => 'Actualice la información de su perfil de cuenta y dirección de correo electrónico.',
    'unverifed' => 'Su dirección de correo electrónico no está verificada.',
    'verification' => 'Haga clic aquí para reenviar el correo electrónico de verificación.',
    'new_verifications' => 'Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.',

    'acc_delete' => 'Eliminar Cuenta',
    'del_warning' => 'Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.',
    'del_conf' => '¿Está seguro de que desea eliminar su cuenta?',
    'password_confirm_warning' => 'Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.',

    'update_password' => 'Actualizar Contraseña',
    'password_warning' => 'Asegúrese de que su cuenta esté utilizando una contraseña larga y aleatoria para mantenerse segura.',
    'current_password' => 'Contraseña Actual',
    'new_password' => 'Nueva Contraseña',
    'saved' => 'Guardado.',

    'welcome_groups' => 'Bienvenido a la interfaz de Gestión de Grupos! Aquí puedes ver todos los grupos de los que eres miembro. En la tabla encontrarás a tus compañeros, al líder del grupo y toda la información importante. Simplemente haz clic en el nombre del grupo para ver las tareas asociadas.',

    'remember_me' => 'Recuérdame',
    'login' => 'Iniciar sesión',

    'group_created' => 'Nuevo grupo creado: :name',
    'meeting_created' => 'Nueva reunión creada: :title',
    'task_created' => 'Nueva tarea creada: :title',
    'task_due_today' => "¡La tarea ':title' vence hoy!",
    'task_updated' => "La tarea ':title' ha sido actualizada!",


    'view_all' => 'Ver todo',

    'dark_mode' => 'Modo oscuro',
    'toggle_theme' => 'Alternar entre modo claro y oscuro',

];
