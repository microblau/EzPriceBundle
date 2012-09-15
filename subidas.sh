#!/bin/bash
# usage:   ./diffscp.sh <init_version> <final_version>
# example: ./diffscp.sh 303 304

repo_url=http://svn.tantacom.com:2112/svn/general/efl/trunk

# Mostramos cambios al usuario antes de subir
clear
echo ""; echo "";
svn diff --summarize -r $1:$2 $repo_url

echo ""; echo ""; echo "Se instalarán los ficheros listados anteriormente. ¿continuar (s/n)? ";
read -n1 op; echo ""; echo "";

case $op in
		'S')  ;;
		's')  ;;
		*) exit ;;
esac

# Export diff files
for i in $(svn diff --summarize -r $1:$2 $repo_url | awk '{ print $2 }'); 
do
	p=diff_$1_$2/$(echo $i | sed -e "s{$repo_url/{{");
	mkdir -p $(dirname $p);
	svn export $i $p --force;
done

# Compress files
cd diff_$1_$2
tar -czf diff_$1_$2.tgz *

# Send files to main server
scp diff_$1_$2.tgz wwwuser@efl.es:.

# Login into main machine, send to others machines and install
ssh wwwuser@efl.es << EOT
tar -xzf diff_$1_$2.tgz -C /var/www/lefebvre >/dev/null 2>&1
rm diff_$1_$2.tgz
EOT

# Delete files
cd ..
rm -Rf diff_$1_$2
