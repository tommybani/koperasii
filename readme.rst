untuk login admin.

username admin
password admin


untuk login anggota bisa di atur dari dari menu anggota.

jika ada yang error querynya maka execute query dibawah ini.
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
