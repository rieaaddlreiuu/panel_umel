create table panel(
    id integer primary key autoincrement,
    width int(11) not null,
    height int(11) not null,
    pic_path varchar(127) not null,
    name varchar(127)
);
drop table panel_chk;
create table panel_chk(
    panel int(11) not null,
    num int(11) not null,
  is_set int(11) not null,
  primary key(panel,num)
);