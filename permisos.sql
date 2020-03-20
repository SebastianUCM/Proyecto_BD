connect /as sysdba
create user trabajo identified by trabajo ;
grant all privileges to trabajo;

create user trabajo_cliente identified by trabajo_cliente
default tablespace system;
create role cliente_rol;
grant create session to cliente_rol;
grant cliente_rol to trabajo_cliente;

create user trabajo_visitante identified by trabajo_visitante
default tablespace system;
create role visitante_rol;
grant create session to visitante_rol;
grant visitante_rol to trabajo_visitante;

connect trabajo/trabajo
grant select on trabajo.pais to cliente_rol;
grant select on trabajo.CIUDAD to cliente_rol;
grant select on trabajo.ITINERARIO to cliente_rol;
grant select on trabajo.PASAJERO to cliente_rol;
grant select on trabajo.AEROPUERTO to cliente_rol;
grant select on trabajo.ORIGEN to cliente_rol;
grant select on trabajo.DESTINO to cliente_rol;
grant select on trabajo.VUELO to cliente_rol; 
grant select on trabajo.VUELO_ASIENTO to cliente_rol; 
grant select on trabajo.TARIFA to cliente_rol; 
grant select on trabajo.ASIENTO to cliente_rol; 
grant select on trabajo.AEROPUERTO to cliente_rol;
grant select on trabajo.BANCO to cliente_rol;
grant select on trabajo.BOLETA to cliente_rol;
grant select on trabajo.CARRITO to cliente_rol;
grant select on trabajo.CLIENTE to cliente_rol;
grant select on trabajo.DETALLE to cliente_rol;
grant select on trabajo.PASAJE to cliente_rol;

grant insert on trabajo.PASAJE to cliente_rol;
grant insert on trabajo.CARRITO to cliente_rol;
grant insert on trabajo.PASAJERO to cliente_rol;
grant insert on trabajo.BOLETA to cliente_rol;
grant insert on trabajo.DETALLE to cliente_rol;


grant update on trabajo.PASAJERO to cliente_rol; 
grant update on trabajo.PASAJE to cliente_rol; 
grant update on trabajo.BOLETA to cliente_rol; 
grant update on trabajo.VUELO to cliente_rol; 
grant update on trabajo.VUELO_ASIENTO to cliente_rol;

grant delete on trabajo.CARRITO to cliente_rol; 
grant delete on trabajo.PASAJE to cliente_rol;


grant execute on INSERTAR_PASAJE to cliente_rol;
grant execute on INSERTAR_PASAJERO to cliente_rol;
grant execute on INSERTAR_PASAJERO_PASAJE TO trabajo_cliente; 
grant execute on INSERTAR_ASIENTO_PASAJE to cliente_rol;
grant execute on GENERAR_COMPRA TO trabajo_cliente;
grant execute on DISMINUIR_CAPACIDAD_VUELO TO trabajo_cliente;
grant execute on INSERTAR_PASAJE_DOS to cliente_rol;
grant execute on INSERTAR_PASAJERO_DOS to cliente_rol;
grant execute on QUITAR_PASAJERO to cliente_rol;
grant execute on GENERAR_COMPRA_DOS TO trabajo_cliente;
grant execute on AUMENTAR_CAPACIDAD_VUELO TO trabajo_cliente;
grant execute on INICIAR_SESION to cliente_rol;
grant execute on OBTENER_PAGO_MULTA to cliente_rol;
grant execute on OBTENER_PAGO_TOTAL to cliente_rol;


grant select on trabajo.pais to visitante_rol;
grant select on trabajo.CIUDAD to visitante_rol;
grant select on trabajo.ITINERARIO to visitante_rol;
grant select on trabajo.AEROPUERTO to visitante_rol;
grant select on trabajo.ORIGEN to visitante_rol;
grant select on trabajo.DESTINO to visitante_rol;
grant select on trabajo.VUELO to visitante_rol; 
grant select on trabajo.VUELO_ASIENTO to visitante_rol; 
grant select on trabajo.TARIFA to visitante_rol; 
grant select on trabajo.ASIENTO to visitante_rol; 
grant select on trabajo.AEROPUERTO to visitante_rol;
grant select on trabajo.CLIENTE to visitante_rol;

grant execute on INSERTAR_CLIENTE to visitante_rol;
