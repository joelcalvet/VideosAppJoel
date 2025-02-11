# Projecte VideosApp

## Descripció del projecte
VideosApp és una aplicació per gestionar vídeos. Utilitzem TDD i AAA per garantir la qualitat del codi.

## Sprint 1: Creació del projecte

### Objectius
- Crear un projecte anomenat VideosAppJoel amb Jetstream Livewire, PHPUnit, Teams i SQLite.

### Activitats
- Crear test de `Helpers` per comprovar creació d'usuaris (usuari bàsic i professor) amb nom, email, contrasenya xifrada i associats a un equip.
- Crear helpers a la carpeta `app`.
- Configurar credencials d'usuaris a `config` amb valors `.env`.

## Sprint 2: Millores i noves funcionalitats

### Objectius
- Corregir errors de l'Sprint 1.
- Configurar `phpunit` per utilitzar base de dades temporal.
- Crear migració de vídeos (id, title, description, url, published_at, previous, next, series_id).
- Desenvolupar `VideosController` i model de vídeos.
- Crear helper per vídeos predeterminats.
- Configurar `DatabaseSeeder` per afegir usuaris i vídeos predeterminats.
- Crear layout `VideosAppLayout`.
- Desenvolupar ruta i vista per mostrar vídeos.
- Escriure tests per comprovar formatació de dates de vídeos.
- Afegir tests de funcionalitat per veure vídeos existents i gestionar vídeos inexistents.
- Instal·lar i configurar `Larastan` per analitzar i corregir errors del codi.

# Sprint 3: Correcció d'errors i permisos d'usuari

## Objectius

- Corregir els errors del 2n sprint.
- Instal·lar el paquet spatie/laravel-permission. [Documentació](https://spatie.be/docs/laravel-permission)
- Crear una migració per afegir el camp `super_admin` a la taula d'usuaris.
- Afegir les funcions `testedBy()` i `isSuperAdmin()` al model d'usuaris.
- Afegir el rol `superadmin` al professor a la funció `create_default_professor` dels helpers.
- Crear la funció `add_personal_team()` per separar la creació d'equips dels usuaris.
- Crear les funcions:
    - `create_regular_user()` (Regular, regular@videosapp.com, 123456789).
    - `create_video_manager_user()` (Video Manager, videosmanager@videosapp.com, 123456789).
    - `create_superadmin_user()` (Super Admin, superadmin@videosapp.com, 123456789).
- `define_gates()` i `create_permissions()` per gestionar permisos.

## A app/Providers/AppServiceProvider

- Registrar les polítiques d'autorització.
- Definir les gates d'accés.
- Afegir els permisos i els usuaris superadmin, regular user i video manager per defecte al `DatabaseSeeder`.
- Publicar els stubs personalitzats. Exemple: Personalització de stubs en Laravel.

## Crear el test `VideosManageControllerTest` a `tests/Feature/Videos` per comprovar la formatació del vídeo

- `user_with_permissions_can_manage_videos()`
- `regular_users_cannot_manage_videos()`
- `guest_users_cannot_manage_videos()`
- `superadmins_can_manage_videos()`
- `loginAsVideoManager()`
- `loginAsSuperAdmin()`
- `loginAsRegularUser()`

## Crear el test `UserTest` a `tests/Unit` i verificar la funció `isSuperAdmin()`

## Afegir a `resources/markdown/terms` el resum del sprint

## Verificar tots els fitxers creats amb Larastan

