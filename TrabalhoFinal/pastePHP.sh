# cp *.c /mnt/c/Users/bruni/OneDrive/Documentos/GitHub/CGR0002
# cp * -r /mnt/c/Users/bruni/OneDrive/Documentos/GitHub/CGR0002
mkdir -p /var/www/html/Trabalho02/
rsync -av --exclude='*.sh' * /var/www/html/Trabalho02/