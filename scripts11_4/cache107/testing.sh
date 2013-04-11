export OS_USERNAME=admin;
export OS_PASSWORD=ubuntu;
export OS_TENANT_NAME=admin;
export OS_AUTH_URL=http://127.0.0.1:5000/v2.0/;
wget $1;
swift upload $2 $3;
rm $3;
#echo "done in 107.." > output107

