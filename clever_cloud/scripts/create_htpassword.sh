#!/bin/bash

if [[ -v HTPASSWD_USER  && -v HTPASSWD_PASSWORD && -v HTACCESS_PATH ]]; then
  HTPASSWD_PATH=${APP_HOME}/.htpasswd
  cat <<EOT >> ${APP_HOME}/${HTACCESS_PATH}
<IfFile ${HTPASSWD_PATH}>
    AuthType Basic
    AuthName "internal"
    AuthUserFile ${HTPASSWD_PATH}
    Require valid-user
</IfFile>
EOT

  htpasswd -s -b  -c ${HTPASSWD_PATH} ${HTPASSWD_USER} ${HTPASSWD_PASSWORD}

fi