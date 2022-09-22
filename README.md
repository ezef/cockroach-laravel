## Proof of concept for CockroachDB 
#### with Multi-region configuration with data domiciling compliance. Using Laravel 9

The main purpose of the following is to test CockroachDB, a PostgreSQL-derivate RDBMS which has the capability to manage data locality (among others)

The main idea is around patients and medical practices taken. We will have four entities: `hospitals`, `countries`, `patients` and `medical_practices`


1. install CockroachDB https://www.cockroachlabs.com/docs/v22.1/install-cockroachdb-linux.html#download-the-binary
2. Start multi node cluster locally. Look for IP on the output. User will be root without password
   
```
   cockroach demo --global --nodes 9 --no-example-database --insecure
```

This will spin up a CockroacbDB demo cluster with 9 nodes distributed in 3 regions and simulate latency between regions. by default is created an empty database called defaultdb. We will use it.

4. Set up proper connection config on .ENV

```
DB_CONNECTION=pgsql
DB_HOST=IP_OF_CLUSTER
DB_PORT=26257
DB_DATABASE=defaultdb
DB_USERNAME=root
DB_PASSWORD=

```
4. run 
```shell
sail artisan migrate --seed
```

Now we have 4 main tables on DB with fake data: `hospitals`, `countries`, `patients` and `medical_practices`

5. For tackle data domiciling, let's suppose that we need to store patients rows for EU countries on EU region and non-EU patients will be stored on  US east region.
Also, for test latency, we will set locality for all medical practices on US west

running the following command will adjust the DB schema accordinly to meet these requirements

```
sail artisan cockroachdb:adjust-schema
```

You can see the code on `AdjustSchemaForDataDomiciling` command class



### Resources

https://www.cockroachlabs.com/docs/v22.1/data-domiciling.html
https://www.cockroachlabs.com/docs/stable/cockroach-demo.html#run-load-against-a-demo-cluster

###Useful commands

Connect to a particular node of CockroachDB
```
cockroach sql --url='postgres://demo:demo53628@127.0.0.1:26259?sslmode=require'
```
