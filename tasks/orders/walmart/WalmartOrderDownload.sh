#!/bin/bash
pwd=$(cd `dirname $0`; pwd)
#echo $pwd

#返回上一级目录
pwd2=$(dirname $pwd)
#echo $pwd2

#返回上一级目录
pwd3=$(dirname $pwd2)
#echo $pwd3

#返回上一级目录
pwd4=$(dirname $pwd3)
#echo $pwd4
php think WalmartOrderDownloadAccountList
sleep 5

#加拿大站点
lastStr="-ca"
file=$pwd4/app/command/order/walmart/walmart_order_download_account.list


if [ -f "$file" ]
then
        cat $file | while read account
        do
			php think WalmartOrderDownload $account 'Acknowledged' &
		    sleep 1
        done
else
        echo "file is not existed!"
fi




