#!/usr/bin/python3

from http.server import HTTPServer, BaseHTTPRequestHandler
import pwd
import grp
import base64
import json

class HandleHTTPUsersGroups(BaseHTTPRequestHandler):

    def do_POST(self):
        auth = self.headers.get("Authorization")

        if auth == None:
            self.send_response(401)
            self.send_header("WWW-Authenticate", "Basic")
            self.end_headers()
            return

        auth = auth.replace("Basic ", "")
        auth = base64.b64decode(auth).decode()
        user = auth.split(":")[0]
        password = auth.split(":")[1]

        if user != "test" or password != "abcABC123":
            self.send_response(401)
            self.end_headers()
            return

        if self.path == "/api/users":
            users = {}

            for u in pwd.getpwall():
                users[str(u.pw_uid)] = u.pw_name

            self.send_response(200)
            self.end_headers()
            self.wfile.write(json.dumps(users).encode())

        if self.path == "/api/groups":
            groups = {}

            for g in grp.getgrall():
                groups[str(g.gr_gid)] = g.gr_name

            self.send_response(200)
            self.end_headers()
            self.wfile.write(json.dumps(groups).encode())

HTTPServer(("127.0.0.1", 3000), HandleHTTPUsersGroups).serve_forever()

