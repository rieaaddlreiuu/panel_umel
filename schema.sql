create table panel(
    id integer primary key autoincrement,
    width int(11) not null,
    height int(11) not null,
    pic_path varchar(127) not null,
    name varchar(127)
);

create table panel_chk(
    id integer primary key autoincrement,
    panel int(11) not null,
    num int(11) not null
);