/* ************************************************************************************ */
/* ******************************* Pojazdy ******************************************** */
/* ************************************************************************************ */
drop table if exists Pojazd;
show warnings;
create table Pojazd (
	Nazwa varchar(30),
	ID int not null auto_increment primary key,
	Typ varchar(2) null,
	Nacja varchar(5) not null,
	Masa float(4,2) null,
	Dlugosc float(4,2) null,
	Szerokosc float(4,2) null,
	Wysokosc float(4,2) null,
	Ilosc_wyprodukowanych_egzemplarzy int null,
	Liczba_zalogantow int null,
	Poczatek_produkcji int null,
	Koniec_produkcji int null,
	Grubosc_pancerza_w_najcienszym_miejscu int null,
	Grubosc_pancerza_w_najgrubszym_miejscu int null,
	Moc_silnika int null,
	Max_predkosc int null,
	Zasieg int null,
	Nazwa_glownego_uzbrojenia varchar(30) null,
	Kaliber float(5,2) null,
	Zdjecie varchar(50) null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/pojazd_pancerny.csv' into table Pojazd fields terminated by ';' enclosed by '"' lines terminated by '\r\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ******************************* Egzemplarz ***************************************** */
/* ************************************************************************************ */
drop table if exists Egzemplarz;
show warnings;
create table Egzemplarz (
	ID_pojazdu int null,
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Rok_produkcji int null,
	ID_wlasciciela int not null,
	Kod_wlasciciela varchar(1) not null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/egzemplarz.csv' into table Egzemplarz fields terminated by ';' enclosed by '"' lines terminated by '\r\n';
show warnings;


/* ************************************************************************************ */
/* ******************************* Bierze_udzial ************************************** */
/* ************************************************************************************ */
drop table if exists Udzial_w_wydarzeniu;
show warnings;
create table Udzial_w_wydarzeniu (
	ID_pojazdu int null,
	ID_wydarzenia int not null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/bierze_udzial.csv' into table Udzial_w_wydarzeniu fields terminated by ';' lines terminated by '\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ******************************* Gra ************************************************ */
/* ************************************************************************************ */
drop table if exists Gra_komputerowa;
show warnings;
create table Gra_komputerowa (
	Nazwa varchar(30) not null,
	Kod_gry varchar(3) NOT NULL PRIMARY KEY,
	Gatunek varchar(10) not null,
	Rok_wydania int not null,
	Logo varchar(50) not null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/gra.csv' into table Gra_komputerowa fields terminated by ';' enclosed by '"' lines terminated by '\r\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ******************************* Implementuje *************************************** */
/* ************************************************************************************ */
drop table if exists Implementacja;
show warnings;
create table Implementacja (
	ID_pojazdu int null,
	Kod_gry varchar(3) null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/implementuje.csv' into table Implementacja fields terminated by ';' lines terminated by '\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ******************************* Kolekcjoner **************************************** */
/* ************************************************************************************ */
drop table if exists Kolekcjoner;
show warnings;
create table Kolekcjoner (
	ID int not null auto_increment primary key,
	Imie varchar(20) not null,
	Nazwisko varchar(20) not null,
	Adres varchar(30) not null,
	Miasto varchar(30) not null,
	Nr_tel varchar(20) not null,
	E_mail varchar(50) not null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/kolekcjoner.csv' into table Kolekcjoner fields terminated by ';' enclosed by '"' lines terminated by '\r\n';
show warnings;


/* ************************************************************************************ */
/* ************************************ Muzeum **************************************** */
/* ************************************************************************************ */
drop table if exists Muzeum;
show warnings;
create table Muzeum (
	ID int not null auto_increment primary key,
	Nazwa varchar(100) not null,
	Miasto varchar(30) not null,
	Kraj varchar(30) not null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/muzeum.csv' into table Muzeum fields terminated by ';' enclosed by '"' lines terminated by '\r\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ************************************ Panstwa *************************************** */
/* ************************************************************************************ */
drop table if exists Panstwo;
show warnings;
create table Panstwo (
	Kod varchar(5) not null primary key,
	Nazwa varchar(100) not null,
	Flaga varchar(50) not null
);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/panstwa.csv' into table Panstwo fields terminated by ';' enclosed by '"' lines terminated by '\r\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ************************************ Poprzednicy *********************************** */
/* ************************************************************************************ */
drop table if exists Nastepowanie;
show warnings;
create table Nastepowanie (
	Poprzednik int null,
	Nastepnik int null
	);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/poprzednicy.csv' into table Nastepowanie fields terminated by ';' lines terminated by '\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ************************************ Przekazuje ************************************ */ 
/* ************************************************************************************ */
drop table if exists Przekazywanie;
show warnings;
create table Przekazywanie (
	ID_transakcji int not null primary key,
	ID_kolekcjonera int null,
	ID_egzemplarza int null,
	ID_muzeum int null,
	Kwota int not null,	
	Data_przekazania date not null
	);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/przekazuje.csv' into table Przekazywanie fields terminated by ';' enclosed by '"' lines terminated by '\r\n';
show warnings;


/* ************************************************************************************ */
/* ********************************** Uzywany_przez *********************************** */
/* ************************************************************************************ */
drop table if exists Uzytkowanie;
show warnings;
create table Uzytkowanie (
	ID_pojazdu int not null,
	Kod_panstwa varchar(5) null
	);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/uzywany_przez.csv' into table Uzytkowanie fields terminated by ';' enclosed by '"' lines terminated by '\r\n' ignore 1 lines;
show warnings;


/* ************************************************************************************ */
/* ********************************** Wydarzenie ************************************** */
/* ************************************************************************************ */
drop table if exists Wydarzenie;
show warnings;
create table Wydarzenie (
	Miejsce varchar(50) not null,
	ID int not null auto_increment primary key,
	Okres_czasu varchar(30) not null,
	Opis varchar(200) not null
	);
show warnings;

load data infile 'E:/bazy danych/projekt bazy/csv/wydarzenie.csv' into table Wydarzenie fields terminated by ';' enclosed by '"' lines terminated by '\r\n' ignore 1 lines;
show warnings;
