```bash

php artisan resource-file:create Singer --fields="id,name,name:gender;options:male|female;html-type:select;data-type:enum,name:music_type;html-type:checkbox;options:country|pop|rock|jazz|rap,is_retired"

php artisan create:layout "Music Library"   

php artisan create:resources Singer --with-migration

#####################################################

# use --force flag   to recreate resources

# The following command was used to append the "notes" field to the singers.json resource file
php artisan resource-file:append Singer --fields=notes

php artisan resource-file:create SongCategory --fields=id,name

php artisan create:resources SongCategory --with-migration

php artisan resource-file:create Song --fields=id,title,album,singer_id,release_year,song_category_id,file

php artisan create:resources Song --with-migration

php artisan migrate-all

# Foreign relation edit the field attribute for the form to display a different column (like not to show ids, and rather name)

# is-on-index column edition on views

```