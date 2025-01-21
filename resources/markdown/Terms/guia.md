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

