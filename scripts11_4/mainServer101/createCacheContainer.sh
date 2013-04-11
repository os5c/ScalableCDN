export OS_USERNAME=admin
export OS_PASSWORD=ubuntu
export OS_TENANT_NAME=admin
export OS_AUTH_URL=http://127.0.0.1:5000/v2.0
swift post $1
swift post -r '.r:*' $1
