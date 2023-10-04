create table panel(
    id int(11) primary key auto_increment,
    width int(11) not null,
    height int(11) not null,
    pic_path varchar(127) not null,
    name varchar(127)
);

create table panel_chk(
    id int(11) primary key auto_increment,
    panel int(11) not null,
    num int(11) not null
);