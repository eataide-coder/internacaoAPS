#!/bin/sh

# Constantes
SERVIDOR_PRODUCAO="162.215.221.111"
USUARIO_REMOTO="root"
PORTA_SSH=22022

# Valida parametros
if [ $# -ne 4 ]; then
    echo '\n****************************************************************************************************************\n';
    echo '   Uso: importa_container_hub.sh [nome_sistema] [id_ou_nome_container] [nome_imagem] [porta_aplicacao]    \n';
    echo '   Ex: ./importa_container_hub.sh censoDocker 4c4d censodocker 7000 \n';
    echo '****************************************************************************************************************\n';
    exit 1;
fi

# Recebe parametros
NOME_SISTEMA=$1
ID_NOME_CONTAINER_LOCAL=$2
NOME_IMAGEM="${3}_prod"
PORTA_APLICACAO=$4

# Realiza a build
docker build -t $NOME_IMAGEM .

# Transfere imagem para o docker hub
docker tag $NOME_IMAGEM smsriodocker/app:$NOME_SISTEMA
docker push smsriodocker/app:$NOME_SISTEMA

# (Servidor de producao) Remove container antigo (caso exista)
ssh -p $PORTA_SSH $USUARIO_REMOTO@$SERVIDOR_PRODUCAO "docker rm -f $NOME_SISTEMA"

# (Servidor de producao) Remove imagem antiga (caso exista)
ssh -p $PORTA_SSH $USUARIO_REMOTO@$SERVIDOR_PRODUCAO "docker rmi smsriodocker/app:$NOME_SISTEMA"

# (Servidor de producao) Recupera imagem do docker hub
ssh -p $PORTA_SSH $USUARIO_REMOTO@$SERVIDOR_PRODUCAO "docker pull smsriodocker/app:$NOME_SISTEMA"

# (Servidor de producao) Roda a imagem no container
ssh -p $PORTA_SSH $USUARIO_REMOTO@$SERVIDOR_PRODUCAO "docker run -d -p $PORTA_APLICACAO:8000 --name $NOME_SISTEMA --network smsrio --restart unless-stopped -m=2g --add-host=db.smsrio.org:162.215.221.118 --add-host=web2.smsrio.org:192.163.240.5 smsriodocker/app:$NOME_SISTEMA"

# Apaga imagem gerada no servidor dev
docker rmi -f smsriodocker/app:$NOME_SISTEMA
docker rmi -f $NOME_IMAGEM
