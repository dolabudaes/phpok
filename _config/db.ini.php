;<?php exit("<h1>Access Denied</h1>");?>

; ֧�� mysqli pdo_mysql http��PHP����5.3����û�����ʹ��mysqli��pdo_mysql
; http ģʽ��Ҫ���� libs/curl.php �� libs/token.php �ļ�����ģʽ��Ҫ Server ����ϣ����ܱȽ���
; ��ע�� http ģʽ��������׶�
file = "mysqli"

; ���ݿ����������������дlocalhost��127.0.0.1
; ��ʹ�� http ʱ��������д�������� IP�������ڽ���޷��ϱ���������
host = "127.0.0.1"

; ���ݿ�������Ķ˿ںţ�Ĭ����3306
; ʹ�� http ģʽ������Ч
port = "3306"

; �������ݿ���˺�
; ʹ�� http ģʽʱ����������֤�˺ţ�����Ҫ������
user = "root"

; �������ݿ������
; ʹ�� http ģʽʱ�Ļ�����֤������Ҫ������
pass = "root"

; ���ݿ�����
; ʹ�� http ģʽʱ������д���ʵ�ַ���� http://127.0.0.1/index.php �� https://127.0.0.1/index.php ���������ӵ�ַ
; ʹ�� sqlite �� pdo_sqlite ʱ������д���ݿ���Ե�ַ��Ҫȷ���ļ�����
; ʹ�� mysqli �� pdo_mysql ʱ������д���ݿ�����
data = "phpok"

; ���ݱ�ǰ׺��ʵ��ͬһ�����ݿⰲװ��ͬ�汾����Ĭ��ʹ�� qinggan_
; ʹ�� http ģʽʱ��ע�����ɵ� SQL �ļ��Ჹ��ǰ׺
prefix = "qinggan_"

; ʹ��ͨ�����ӣ�������������Mysql��Linux��һ����/tmp/mysql.sock�������ж����������û�ʹ�ã�
socket = ""

; �Ƿ���ԣ����ϵͳ��debugΪtrueʱ�����ӡ������ҳ��ִ�е�SQL���
debug = false

; ��ʱ���棬��Ӧ�ô�����С��ѯ���ظ���ѯ��һ�㲻�ÿ�����
cache = false

