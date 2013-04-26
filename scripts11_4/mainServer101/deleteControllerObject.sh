export OS_USERNAME=admin
export OS_PASSWORD=ubuntu
export OS_TENANT_NAME=admin
export OS_AUTH_URL=http://127.0.0.1:5000/v2.0/
if [ "$#" -ne 2 ]; then
echo ;
echo "USAGE: param1: Container name param2: Object name";
echo ;
else
echo ;
echo "Deleting Object $2 in Container $1";
echo ;
swift delete $1 $2
sudo sshpass -p ubuntu ssh -o StrictHostKeyChecking=no stack@$3 'bash -s' < deleteObject.sh $1 $2
sudo sshpass -p ubuntu ssh -o StrictHostKeyChecking=no stack@$4 'bash -s' < deleteObject.sh $1 $2
fi
