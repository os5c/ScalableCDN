echo $1;
if [ "$#" -ne 1 ]; then
echo "Create container: Container Name NOT SPECIFIED";
else
echo "Creating container"+$1;
swift post $1;
swift post -r '.r:*' $1
sudo sshpass -p ubuntu ssh -o StrictHostKeyChecking=no stack@192.168.100.107 'bash -s' < createCacheContainer.sh $1
sudo sshpass -p ubuntu ssh -o StrictHostKeyChecking=no stack@192.168.100.105 'bash -s' < createCacheContainer.sh $1
fi
