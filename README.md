## 初期設定
mysqlコンテナに入って、以下の設定を行う
```
chmod 644 /etc/mysql/conf.d/my.cnf
```

次にデータベースにアクセスして以下の設定を行う
```
use mysql
alter user 'minori' identified with mysql_native_password by 'password';
```
